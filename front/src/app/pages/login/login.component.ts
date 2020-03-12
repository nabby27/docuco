import { Component, OnInit } from '@angular/core';
import { Validators, FormGroup, FormBuilder } from '@angular/forms';
import { LoginAction } from 'src/domain/users/actions/login.action';
import { RouterService } from 'src/infraestructure/services/router.service';
import { UsersRepositoryAPI } from 'src/infraestructure/repositories/users.repository.api';
import { StorageService } from 'src/infraestructure/services/storage.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  loginForm: FormGroup;
  email: string;
  password: string;
  remind: boolean;
  isLogin: boolean;

  constructor(
    private fb: FormBuilder,
    private routerService: RouterService,
    private usersRepository: UsersRepositoryAPI,
    private storageService: StorageService
  ) { }

  ngOnInit() {
    this.isLogin = false;
    this.setFormData();
  }

  setFormData() {
    this.loginForm = this.fb.group({
      email: [{ value: this.email, disabled: false }, [Validators.required, Validators.email]],
      password: [{ value: this.password, disabled: false }, [Validators.required]]
    });
  }

  async login() {
    const loginAction = new LoginAction(this.usersRepository, this.routerService, this.storageService);
    loginAction.execute(this.loginForm.value.email, this.loginForm.value.password);
  }

  ngOnDestroy() {
    this.isLogin = false;
  }

}
