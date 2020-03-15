import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UsersService } from 'src/app/services/users.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { RouterService } from 'src/app/services/router.service';

@Component({
  selector: 'app-login-card',
  templateUrl: './login-card.component.html',
  styleUrls: ['./login-card.component.scss']
})
export class LoginCardComponent {

  loginForm: FormGroup;
  email: string;
  password: string;
  remind: boolean;
  isLogin: boolean;

  constructor(
    private fb: FormBuilder,
    private usersService: UsersService,
    private snackBar: MatSnackBar,
    private routerService: RouterService
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
    this.isLogin = true;
    const logginSuccess = await this.usersService.doLogin(this.loginForm.value.email, this.loginForm.value.password);
    if (!logginSuccess) {
      this.showMessage('Email o contraseña incorrectos');
      this.isLogin = false;
    } else {
      await this.usersService.getCurrentUser();
      this.routerService.goTo('/home');
    }
  }

  private showMessage(message: string) {
    this.snackBar.open(message, null, {
      duration: 5000,
      verticalPosition: 'top'
    });
  }

}
