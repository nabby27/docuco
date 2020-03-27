import { Component, OnInit } from '@angular/core';
import { UsersService } from '../services/users.service';
import { ScreenService } from '../services/screen.service';

@Component({
  selector: 'app-layout',
  templateUrl: './layout.component.html',
  styleUrls: ['./layout.component.scss']
})
export class LayoutComponent implements OnInit {

  isDesktopScreen: boolean;
  
  constructor(
    private usersService: UsersService,
    private screenService: ScreenService
  ) {}

  ngOnInit() {
    this.checkScreenSize();
  }

  userCanEdit() {
    return this.usersService.hasPermissionToEdit();
  }

  checkScreenSize = () => {
    this.isDesktopScreen = this.screenService.isDesktopScreen();

    window.onresize = () => {
      this.isDesktopScreen = this.screenService.isDesktopScreen();
    };
  }

}
