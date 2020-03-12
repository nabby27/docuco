import { Injectable } from '@angular/core';
import { StorageServiceInterface } from 'src/domain/shared/services/storage.service.interface';
import { Token } from 'src/domain/shared/entities/token';
import { User } from 'src/domain/users/entities/user';

@Injectable({
  providedIn: 'root'
})
export class StorageService implements StorageServiceInterface {

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
