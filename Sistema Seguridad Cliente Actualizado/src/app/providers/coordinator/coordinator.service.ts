import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import { map, catchError, tap } from 'rxjs/operators';

const url = 'http://localhost:8080/';
const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json'
  })
};

@Injectable({
  providedIn: 'root'
})
export class CoordinatorService {

  constructor(
    private http: HttpClient
  ) {

  }

  test(): Observable<any> {
    return this.http.get(url + 'persons').pipe(
      map(this.extractData));
  }

  getCoordinador(): Observable<any> {
    return this.http.get(url + 'coordinators').pipe(
      map(this.extractData));
  }

  addCoordinador(coordinator): Observable<any> {
    console.log(coordinator);
    return this.http.post<any>(url + 'coordinators', JSON.stringify(coordinator), httpOptions).pipe(
      tap((product) => console.log(`added coordinator w/ id=${coordinator.id}`)),
      catchError(this.handleError<any>('addCoordinator'))
    );
  }

  updateCoordinador(id, coordinator): Observable<any> {
    return this.http.put(url + 'coordinators/', JSON.stringify(coordinator), httpOptions).pipe(
      tap(_ => console.log(`updated coordinator id=${id}`)),
      catchError(this.handleError<any>('updateCoordinator'))
    );
  }

  private extractData(res: Response) {
    const body = res;
    return body || {};
  }

  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      console.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }
}
