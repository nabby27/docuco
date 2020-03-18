import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { StorageService } from './storage.service';
import { RouterService } from './router.service';
import { Token } from '../entities/token';
import { User } from '../entities/user';
import { map } from 'rxjs/operators';

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
            resolve(true);
          },
          () => {
            resolve(false);
          });
    });
  }

  getAllUsers(): Promise<User[]> {
    return new Promise((resolve, reject) => {
      const users = this.storageService.getAllUser();
      if (users) {
        resolve(users);
      } else {
        this.http.get<User[]>(this.url).pipe(map((response: any) => response.users))
          .subscribe((users: User[]) => {
            this.storageService.saveAllUser(users);
            resolve(users)
          });
      }
    })
  }

  getOneUser(userId): Promise<User> {
    return new Promise((resolve, reject) => {
      this.http.get<User[]>(`${this.url}/${userId}`).subscribe((user: any) => {
        resolve(user.user)
      });
    })
  }

  getCurrentUser(): Promise<User> {
    return new Promise((resolve, reject) => {
      const user = this.storageService.getCurrentUser();
      if (user) {
        resolve(user);
      } else {
        this.http.get<User>(`${environment.baseUrl}/users/current`).subscribe(
          (user: any) => {
            this.storageService.saveCurrentUser(user.user);
            resolve();
          }
        );
      }
    })
  }

  hasPermissionToView() {
    return this.storageService.getCurrentUser().role === 'VIEW' ||
      this.storageService.getCurrentUser().role === 'EDIT' ||
      this.storageService.getCurrentUser().role === 'ADMIN';
  }

  hasPermissionToEdit() {
    return this.storageService.getCurrentUser().role === 'EDIT' ||
      this.storageService.getCurrentUser().role === 'ADMIN';
  }

  hasPermissionToAdmin() {
    return this.storageService.getCurrentUser().role === 'ADMIN';
  }

  isLogged(): boolean {
    return this.storageService.getToken() != null && this.storageService.getCurrentUser() != null;
  }

  doLogout() {
    this.storageService.clear();
    this.routerService.goTo('login');
  }

}
