/**
 * @Author Ruben Veloso Paulos
 */
import { Component, OnInit } from '@angular/core';
import {ApiService} from '../services/api.service';
import {Observable, Subscription} from 'rxjs';
import {debounceTime, map, startWith, switchMap} from 'rxjs/operators';
import { FormControl } from '@angular/forms';
import {Medicament} from '../models/medicament.model';
import {GeocodingApiService} from '../services/geocodingApi.service';
import {log} from 'util';

@Component({
  selector: 'app-medicament',
  templateUrl: './medicament.component.html',
  styleUrls: ['./medicament.component.css']
})
export class MedicamentComponent implements OnInit {
  // Variables
  viewDetails: boolean;
  myControl = new FormControl();
  filteredMed: Observable<any[]>;
  leMed: Medicament = new Medicament();
  isEditable: boolean;
  lat: number;
  lng: number;
  address: Array<any> = [];
  markers: Array<any> = [];

  constructor(private apiService: ApiService, private geocodingAPIService: GeocodingApiService ) {}

  ngOnInit(): void {
    // Cache les éléments
    this.isEditable = true;
    this.viewDetails = false;
    // par défaut centre la carte sur Paris
    this.lat = 48.8534100;
    this.lng = 2.3488000;
    // Barre de recherche
    this.filteredMed = this.myControl.valueChanges.pipe(
      startWith(''),
      debounceTime(400),
      switchMap(value => this.doFilter(value))
    );
  }

  doFilter(value) {
    return this.apiService.getAllMedicament()
      .pipe(
        map(response => response.filter(option => {
          return option.nomCommercial.toLowerCase().indexOf(value.toLowerCase()) === 0;
        }))
      );
  }

  showDetails(event: any) {
    // Affiche la div conteant les détails
    if  (!this.viewDetails) {
      this.viewDetails = true;
    }
    let med: any = [];
    // Récupère le médicament séléctionner et récupère son code
    const medSelectionner = event.option.value.split('-');
    // Subscribe pour récupérer infos d'un medicament
    this.apiService.getUnMedicament(medSelectionner[1]).subscribe( (response) =>  {
      med = response;
      // Initialisation de la variable leMed
      this.leMed.idMed = med[0].id;
      this.leMed.nomCommercial = med[0].nomCommercial;
      this.apiService.getFamilleOfMedicament(med[0].idFamille).subscribe((data) => this.leMed.famille = data[0].libelle);
      this.leMed.composition = med[0].composition;
      this.leMed.effet = med[0].effets;
      this.leMed.contreIndication = med[0].contreIndications;
      // Appel la fonction pour récupérer les coordonnées des médecins ayant eux ces médicaments
      this.getApiMaps(med[0]);
    });
  }

  getApiMaps(med: any) {
    // Vide le tableau
    if (this.markers.length > 0 ) {
      this.markers = [];
    }
    // subscribe a l'observable qui récupère les adresses émise par l'api
    this.apiService.getAdresseFromMedicament(med.id).subscribe( (data) => {
      this.address = data;
      // Pour chaque adresse va chercher l'api google pour récupérer les coordonnées à partir d'une adresse
      this.address.forEach( value => {
        this.geocodingAPIService
          .findFromAddress(value.adresse)
          .subscribe({
            next: response => this.markers.push(response.results[0]),
            error: err => console.error(err)
          });
      });
    });
  }

  makeEditable() {
    this.isEditable = this.isEditable === false;
  }

  onSubmit(event: any) {
    const idMed = event.target.idMed.value;
    const composition = event.target.composition.value;
    const effets = event.target.effets.value;
    const contreIndications = event.target.contreIndications.value;
    // Souscription
    this.apiService.saveMedicament(idMed, composition, effets, contreIndications).subscribe();
    this.isEditable = true;
    alert('Modification effectué !');
  }
}
