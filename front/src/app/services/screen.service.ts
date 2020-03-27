import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ScreenService {

  constructor() { }

  isDesktopScreen(): boolean {
    return window.innerWidth > 991;
  }

}
