import {Subject} from "rxjs";
import {Injectable} from "@angular/core";
import{HttpClient, HttpClientModule} from '@angular/common/http';

@Injectable()

export class AuthService {

visiteurSubject = new Subject<any[]>();
private visiteurs=[];

emitVisiteurSubject(){
  this.visiteurSubject.next(this.visiteurs.slice());
}

constructor(private httpClient: HttpClient){}

getAllVisiteurs(){
  this.httpClient.get<any[]>('https://webserv-gr2.sio-carriat.com/gsbapi/').subscribe(
  (response) => {
    this.visiteurs = response;
    console.log('Load check\n'+this.visiteurs[10].nom)
    this.emitVisiteurSubject();
    }
  );
}

  isAuth = false;
  signIn() {
    return new Promise(
      (resolve, reject) => {
          this.isAuth = true;
          resolve(true);
      }
      );
  }
  // Disconnection
  signOut() {
    this.isAuth = false;
  }




}
