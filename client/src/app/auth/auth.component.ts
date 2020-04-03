import { Component, OnInit } from '@angular/core';
import {AuthService} from '../services/auth.service';
import { Router } from '@angular/router';
import { Subscription } from 'rxjs';


@Component({
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.css']
})
export class AuthComponent implements OnInit {
  // Variables
  authStatus: boolean;
  
  visiteurs: any[];
  visiteurSubscription: Subscription;

  constructor(private authService: AuthService, private router: Router) { }

  ngOnInit(): void {
    this.authStatus = this.authService.isAuth;

    this.authService.getAllVisiteurs();

    this.visiteurSubscription = this.authService.visiteurSubject.subscribe(
    (visiteurs: any[]) => {
      this.visiteurs= visiteurs;
      console.log(this.visiteurs)
    }
      );
    this.authService.emitVisiteurSubject();

  }
 

  onSignIn() {
    this.authService.signIn().then(
      () => {
        this.authStatus = this.authService.isAuth;
        // Envoie lors de la connexion vers la page home
        this.router.navigate(['home']);
      }
    );
  }

  onSignOut() {
    this.authService.signOut();
    this.authStatus = this.authService.isAuth;
  }

}
