import { Injectable } from '@angular/core';
import { CanActivate } from '@angular/router';
import { UsersService } from 'src/app/services/users.service';

@Injectable({
  providedIn: 'root'
})
export class HasPermissionToView implements CanActivate {

  constructor(private usersService: UsersService) { }

  async canActivate(): Promise<boolean> {

    return await this.usersService.hasPermissionToView();

  }

}

