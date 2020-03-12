import { Component, OnInit, Input } from '@angular/core';
import { RouterService } from 'src/infraestructure/services/router.service';
import { StorageService } from 'src/infraestructure/services/storage.service';
import { LogoutAction } from 'src/domain/users/actions/logout.action';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

  constructor(
    private routerService: RouterService,
    private storageService: StorageService
  ) { }

  ngOnInit() {
  }

  logout() {
    const logoutAction = new LogoutAction(this.routerService, this.storageService);
    logoutAction.execute();
  }
}
