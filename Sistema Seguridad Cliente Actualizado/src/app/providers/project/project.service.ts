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
export class ProjectService {

  constructor(
    private http: HttpClient
  ) {

  }

  test(): Observable<any> {
    return this.http.get(url + 'persons').pipe(
      map(this.extractData));
  }

  getProjects(): Observable<any> {
    return this.http.get(url + 'projects').pipe(
      map(this.extractData));
  }

  addProject(project): Observable<any> {
    console.log(project);
    return this.http.post<any>(url + 'projects', JSON.stringify(project), httpOptions).pipe(
      tap((project) => console.log(`added project w/ id=${project.id}`)),
      catchError(this.handleError<any>('addProject'))
    );
  }

  updateProject(id, project): Observable<any> {
    return this.http.put(url + 'projects/', JSON.stringify(project), httpOptions).pipe(
      tap(_ => console.log(`updated project id=${id}`)),
      catchError(this.handleError<any>('updateProject'))
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
