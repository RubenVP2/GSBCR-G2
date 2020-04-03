import { Component, OnInit } from '@angular/core';
import {ApiService} from '../services/api.service';
import {Observable, Subscription} from 'rxjs';
import {debounceTime, map, startWith, switchMap} from 'rxjs/operators';
import { FormControl, FormGroup, NgForm} from '@angular/forms';
import {Medicament} from '../models/medicament.model';

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
  userForm: FormGroup;

  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    // Cache les éléments
    this.isEditable = true;
    this.viewDetails = false;
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
          return option.nomCommercial.toLowerCase().indexOf(value.toLowerCase()) === 0
        }))
      );
  }

  showDetails(med: any) {
    // Affiche la div conteant les détails
    if  (!this.viewDetails) {
      this.viewDetails = true;
    }
    // Initialisation de la variable leMed
    this.leMed.idMed = med.id;
    this.leMed.nomCommercial = med.nomCommercial;
    this.apiService.getFamilleOfMedicament(med.idFamille).subscribe((data) => this.leMed.famille = data[0].libelle);
    this.leMed.composition = med.composition;
    this.leMed.effet = med.effets;
    this.leMed.contreIndication = med.contreIndications;
  }

  makeEditable() {
    this.isEditable = this.isEditable === false;
  }

  onSubmit(event: any) {
    const idMed = event.target.idMed.value;
    const composition = event.target.composition.value;
    const effets = event.target.effets.value;
    const contreIndications = event.target.contreIndications.value;
    this.apiService.saveMedicament(idMed, composition, effets, contreIndications);
  }
}
