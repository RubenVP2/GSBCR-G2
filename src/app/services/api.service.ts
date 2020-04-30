import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { fromEvent, of, Subject} from 'rxjs';
import {tap, map} from 'rxjs/operators';


@Injectable()
export class ApiService {
  private urlApi = 'https://webserv-gr2.sio-carriat.com/gsbapi/';
  // Constructeur
  constructor(private httpClient: HttpClient) {}
  private medicaments = [];

  /**
   * Récupère tous les médicaments
   * pipe() = prend comme arguments les fonctions que vous voulez combiner, et renvoie une nouvelle fonction qui, lorsqu'elle est exécutée, exécute les fonctions composées en séquence.
   * tap() = elle prend des valeurs en entrée, les transforme et les renvoie en sortie.
   */
  getAllMedicament() {
    return this.medicaments.length ?
      of(this.medicaments) :
      this.httpClient.get<any[]>(this.urlApi + '?nomMed').pipe(tap(data => this.medicaments = data));
  }

  /**
   * Récupère les infos d'un médicament
   * @param idMed
   */
  getUnMedicament(idMed: string) {
    return this.httpClient.get(this.urlApi + '?idMed=' + idMed).pipe(map( (res: any) => res));
  }

  /**
   * Récupère le libelle d'une famille d'un médicament depuis son code
   * map() = elle prend des valeurs en entrée, les transforme et les renvoie en sortie comme pour tap et d'autre encore.
   * @param codeFamille
   */
  getFamilleOfMedicament(codeFamille: string) {
    return this.httpClient.get(this.urlApi + '?idFam=' + codeFamille).pipe(map((res: any) => res));
  }

  /**
   * Retourne les adresses depuis un médicament ainsi que le nom + prenom
   * @param idMed
   */
  getAdresseFromMedicament(idMed: string) {
    return this.httpClient.get(this.urlApi + '?idMed3=' + idMed).pipe(map((res: any) => res));
  }

  /**
   * Sauvegarde les modifications des informations d'un médicament
   * @param idMed
   * @param composition
   * @param effets
   * @param contreIndications
   */
  saveMedicament(idMed, composition, effets, contreIndications) {
    // tslint:disable-next-line:max-line-length
    return this.httpClient.get(this.urlApi + '?idMed2=' + idMed + '&composition=' + composition + '&effets=' + effets + '&contreIndications=' + contreIndications).pipe(map((res: any) => res));
  }

  /**
   * Retourne la liste des familles de la bdd
   */
  getLesFamilles() {
    return this.httpClient.get(this.urlApi + '?getFams').pipe(map( (res: any) => res));
  }

  /**
   * Ajoute un médicament à la table medicaments
   */
  addMedicament(id: string , nom: string, idFam: string, composition: string, effets: string, contre: string) {
    // tslint:disable-next-line:max-line-length
    return this.httpClient.get(this.urlApi + '?idMed4=' +  id + '&nom=' + nom + '&Fam=' + idFam + '&composition=' + composition + '&effets=' + effets + '&contreIndications=' + contre).pipe(map( (res: any) => res));
  }

}
