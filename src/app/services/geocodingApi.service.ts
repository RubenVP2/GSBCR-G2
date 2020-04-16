/**
 * @Author Ruben Veloso Paulos
 */
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import {HttpClient} from '@angular/common/http';
import {map} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class GeocodingApiService {
  API_URL: string;
  constructor(private http: HttpClient) {
    this.API_URL = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
  }
  /**
   * Cette méthode retourne les informations d'une adresse
   * @param address
   */
  findFromAddress(address: string): Observable<any> {
    // Tableau contenant les addresses
    const  compositeAddress = [address];
    // Concaténation de l'url + adresse + api key et sensor permet de dire si on peut manipuler la map
    const url = this.API_URL + compositeAddress + '&sensor=true&key=AIzaSyCSQ6KEgdu4BypeiP4SiK23X-j2BxhzVHw';
    // Retourne une observable qui va retourner l'ensemble des informations en json sur notre adresse ( lat, lng, ... )
    return this.http.get(url).pipe(map(response => response as any));
  }
}
