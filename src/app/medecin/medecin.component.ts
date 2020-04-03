import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-medecin',
  templateUrl: './medecin.component.html',
  styleUrls: ['./medecin.component.css']
})
export class MedecinComponent implements OnInit {
  title = 'Medecin';
  medecins = {};

  constructor(private http: HttpClient) { }

  ngOnInit(): void {
  }

  public getMedecins() {
    var medecinName = ((document.getElementById("medecinName") as HTMLInputElement).value);
    this.http.get('https://webserv-gr2.sio-carriat.com/gsbapi/?noms=' + medecinName).subscribe(
      (response) => {
        this.medecins = response;
      },
      (error) => {
        console.log('error', error);
      },
      () => {
        console.log('Complete :>');
      }
    );
  }

}
