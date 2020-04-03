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

  getAllMedicament() {
    return this.medicaments.length ?
      of(this.medicaments) :
      this.httpClient.get<any[]>(this.urlApi + '?nomMed').pipe(tap(data => this.medicaments = data));
  }
  getFamilleOfMedicament(codeFamille: string) {
    return this.httpClient.get(this.urlApi + '?idFam=' + codeFamille).pipe(map((res: any) => res));
  }

  saveMedicament(idMed, composition, effets, contreIndications) {
    // tslint:disable-next-line:max-line-length
    return this.httpClient.get(this.urlApi + '?idMed2=' + idMed + '&composition=' + composition + '&effets=' + effets + '&contreIndications=' + contreIndications).pipe(map((res: any) => res));
  }

}
