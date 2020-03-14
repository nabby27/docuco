import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { StorageService } from './storage.service';
import { RouterService } from './router.service';
import { Token } from '../entities/token';

@Injectable({
  providedIn: 'root'
})
export class UsersService {

  url = `${environment.baseUrl}/users`;

  constructor(
    private http: HttpClient,
    private storageService: StorageService,
    private routerService: RouterService
  ) { }

  doLogin(email: string, password: string): Promise<boolean> {
    return new Promise((resolve, reject) => {
      this.http.post<Token>(`${environment.baseUrl}/login`, { 'email': email, 'password': password })
        .subscribe(
          (token: Token) => {
            this.storageService.saveToken(token);
            this.routerService.goTo('/home');
            resolve(true);
          },
          () => {
            resolve(false);
          });
    });
  }

  isLogged(): boolean {
    return this.storageService.getToken() != null;
  }

  doLogout() {
    this.storageService.clear();
    this.routerService.goTo('login');
  }

}
