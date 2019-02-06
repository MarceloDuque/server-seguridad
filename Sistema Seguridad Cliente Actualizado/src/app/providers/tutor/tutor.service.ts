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
export class TutorService {

  constructor(
    private http: HttpClient
  ) {

  }

  test(): Observable<any> {
    return this.http.get(url + 'persons').pipe(
      map(this.extractData));
  }

  getTutors(): Observable<any> {
    return this.http.get(url + 'tutors').pipe(
      map(this.extractData));
  }

  addTutor(tutor): Observable<any> {
    console.log(tutor);
    return this.http.post<any>(url + 'tutors', JSON.stringify(tutor), httpOptions).pipe(
      tap((tutor) => console.log(`added tutors w/ id=${tutor.id}`)),
      catchError(this.handleError<any>('addTutor'))
    );
  }

  updateTutor(id, tutor): Observable<any> {
    return this.http.put(url + 'tutors/', JSON.stringify(tutor), httpOptions).pipe(
      tap(_ => console.log(`updated tutor id=${id}`)),
      catchError(this.handleError<any>('updateTutor'))
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
