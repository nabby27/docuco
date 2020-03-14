import { Injectable } from '@angular/core';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class RouterService {

  constructor(private router: Router) { }

  goTo(route: string, param?) {
    if (param) {
      this.router.navigate([route, param]);
    } else {
      this.router.navigate([route]);
    }
  }

  getCurrentUrl(): string {
    return this.router.url;
  }

}
