import { BrowserModule } from '@angular/platform-browser';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AuthComponent } from './auth/auth.component';
import {RouterModule, Routes} from '@angular/router';
import { AccueilComponent } from './accueil/accueil.component';
import { AuthService } from './services/auth.service';
import { ErreurComponent } from './erreur/erreur.component';
import {AuthGuard} from './services/auth-guard.service';
import { VisiteComponent } from './visite/visite.component';
import { MedecinComponent } from './medecin/medecin.component';
import { MedicamentComponent } from './medicament/medicament.component';
import {ApiService} from './services/api.service';
import { HttpClientModule } from '@angular/common/http';
<<<<<<< HEAD
=======
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatAutocompleteModule} from '@angular/material/autocomplete';
import {MatInputModule} from '@angular/material/input';
import {MatTableModule} from '@angular/material/table';
import {MatButtonModule} from '@angular/material/button';
>>>>>>> 69751822cca100b25e2a51c440219ef92b8d4ac0

// Les Routes
const appRoutes: Routes = [
  { path: 'connexion', component: AuthComponent},
  { path: 'home', canActivate: [AuthGuard], component: AccueilComponent},
  { path: 'visite', canActivate: [AuthGuard], component: VisiteComponent},
  { path: 'medecin', canActivate: [AuthGuard], component: MedecinComponent},
  { path: 'medicament', canActivate: [AuthGuard], component: MedicamentComponent},
  { path: '', component: AuthComponent},
  { path: 'not-found', component: ErreurComponent},
  { path: '**', redirectTo: '/not-found'},
];

@NgModule({
  declarations: [
    AppComponent,
    AuthComponent,
    AccueilComponent,
    ErreurComponent,
    VisiteComponent,
    MedecinComponent,
    MedicamentComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
<<<<<<< HEAD
    RouterModule.forRoot(appRoutes)
=======
    ReactiveFormsModule,
    FormsModule,
    BrowserAnimationsModule,
    MatFormFieldModule,
    MatAutocompleteModule,
    MatInputModule,
    RouterModule.forRoot(appRoutes),
    MatTableModule,
    MatButtonModule
>>>>>>> 69751822cca100b25e2a51c440219ef92b8d4ac0
  ],
  providers: [
    AuthService,
    AuthGuard,
    ApiService
  ],
  bootstrap: [AppComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class AppModule { }
