import { Injectable } from '@angular/core';
import { Token } from '../entities/token';
import { User } from '../entities/user';

@Injectable({
  providedIn: 'root'
})
export class StorageService {

  constructor() { }

  saveToken(token: Token): void {
    localStorage.setItem('token', this.getStringfyObject(token));
  }

  getToken(): Token {
    return <Token>JSON.parse(localStorage.getItem('token'));
  }

  saveUser(user: User): void {
    localStorage.setItem('user', this.getStringfyObject(user));
  }

  getUser(): User {
    return <User>JSON.parse(localStorage.getItem('user'));
  }

  clear(): void {
    localStorage.clear();
  }

  private getStringfyObject(object: object): string {
    return JSON.stringify(object);
  }

}
