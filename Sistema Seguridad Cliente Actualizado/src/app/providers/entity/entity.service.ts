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
export class EntityService {

  constructor(
    private http: HttpClient
  ) {

  }

  test(): Observable<any> {
    return this.http.get(url + 'persons').pipe(
      map(this.extractData));
  }

  getEntities(): Observable<any> {
    return this.http.get(url + 'entities').pipe(
      map(this.extractData));
  }

  getEntity_types(): Observable<any> {
    return this.http.get(url + 'entity_type').pipe(
      map(this.extractData));
  }


  createEntity(entity): Observable<any> {
    console.log(entity);
    return this.http.post<any>(url + 'entities', JSON.stringify(entity), httpOptions).pipe(
      tap((product) => console.log(`added entities w/ id=${entity.id}`)),
      catchError(this.handleError<any>('addEntity'))
    );
  }

  updateEntity(id, entity): Observable<any> {
    return this.http.put(url + 'entities/' , JSON.stringify(entity), httpOptions).pipe(
      tap(_ => console.log(`updated entity id=${id}`)),
      catchError(this.handleError<any>('updateEntity'))
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
