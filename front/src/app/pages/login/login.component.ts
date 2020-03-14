import { Component, OnInit } from '@angular/core';
import { Validators, FormGroup, FormBuilder } from '@angular/forms';
import { UsersService } from 'src/app/services/users.service';
import { MatSnackBar } from '@angular/material/snack-bar';

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
    private usersService: UsersService,
    private snackBar: MatSnackBar
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
    }
  }

  ngOnDestroy() {
    this.isLogin = false;
  }

  private showMessage(message: string) {
    this.snackBar.open(message, null, {
      duration: 5000,
      verticalPosition: 'top'
    });
  }

}
