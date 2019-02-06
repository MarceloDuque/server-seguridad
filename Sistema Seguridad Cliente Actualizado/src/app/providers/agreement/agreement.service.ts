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

export class AgreementService {

  constructor(
    private http: HttpClient
  ) {

  }

  test(): Observable<any> {
    return this.http.get(url + 'persons').pipe(
      map(this.extractData));
  }

  getAgreements(): Observable<any> {
    return this.http.get(url + 'agreements').pipe(
      map(this.extractData));
  }

  addAgreement(agreement): Observable<any> {
    console.log(agreement);
    return this.http.post<any>(url + 'agreements', JSON.stringify(agreement), httpOptions).pipe(
      tap((product) => console.log(`added agreements w/ id=${agreement.id}`)),
      catchError(this.handleError<any>('addAgreement'))
    );
  }

  updateAgreement(id, agreement): Observable<any> {
    return this.http.put(url + 'agreements/', JSON.stringify(agreement), httpOptions).pipe(
      tap(_ => console.log(`updated agreement id=${id}`)),
      catchError(this.handleError<any>('updateAgreement'))
    );
  }

  private extractData(res: Response) {
    let body = res;
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
