import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AuthComponent } from './auth/auth.component';
import {RouterModule, Routes} from '@angular/router';
import { AccueilComponent } from './accueil/accueil.component';
import { AuthService } from './services/auth.service';
import { ErreurComponent } from './erreur/erreur.component';
import {AuthGuard} from './services/auth-guard.service';

// Les Routes
const appRoutes: Routes = [
  { path: 'connexion', component: AuthComponent},
  { path: 'home', canActivate: [AuthGuard], component: AccueilComponent},
  { path: '', component: AuthComponent},
  { path: 'not-found', component: ErreurComponent},
  { path: '**', redirectTo: '/not-found'},
];

@NgModule({
  declarations: [
    AppComponent,
    AuthComponent,
    AccueilComponent,
    ErreurComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    RouterModule.forRoot(appRoutes)
  ],
  providers: [
    AuthService,
    AuthGuard
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
