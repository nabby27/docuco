import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { environment } from '../../environments/environment';
import { Token } from '../../domain/shared/entities/token';
import { UsersRepositoryInterface } from '../../domain/users/repositories/users.repository.interface';

@Injectable({
  providedIn: 'root'
})
export class UsersRepositoryAPI implements UsersRepositoryInterface {

  url = `${environment.baseUrl}/users`;

  constructor(
    private http: HttpClient
  ) { }

  login(email: string, password: string): Observable<Token> {
    return this.http.post<Token>(`${environment.baseUrl}/login`, { 'email': email, 'password': password })
      .pipe(map((response: any) => response));
  }

}
