import { Component, OnInit } from '@angular/core';
import { Validators, FormGroup, FormBuilder } from '@angular/forms';
import { Subscription } from 'rxjs';
import { Router } from '@angular/router';
import { LoginAction } from 'src/domain/users/actions/login.action';
import { RouterService } from 'src/infraestructure/services/router.service';
import { UsersRepositoryAPI } from 'src/infraestructure/repositories/users.repository.api';

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
    private loginSubscription: Subscription;

    constructor(
        private fb: FormBuilder,
        private router: RouterService,
        private usersRepository: UsersRepositoryAPI
    ) { }

    ngOnInit() {
        this.initData();
        this.setFormData();
    }

    initData() {
        this.isLogin = false;
    }

    setFormData() {
        this.loginForm = this.fb.group({
            email: [{ value: this.email, disabled: false }, [Validators.required, Validators.email]],
            password: [{ value: this.password, disabled: false }, [Validators.required]]
        });
    }

    async login() {
        const loginAction = new LoginAction(this.usersRepository);
        const token = await loginAction.execute(this.loginForm.value.email, this.loginForm.value.password);
        localStorage.setItem('token', token.token);
        this.router.goTo('/home');

        // if (this.loginForm.valid) {
        //   this.loginSubscription = this.authService.doLogin(this.loginForm.value.username, this.loginForm.value.password).subscribe(
        //     response => {
        //       this.router.navigate(['/inventory']);
        //     },
        //     error => {
        //       console.error(error);
        //     }
        //   );
        // }
        // this.loginSubscription.add(() => this.isLogin = false);
        // this.router.navigate(['/inventory']);
    }

    ngOnDestroy() {
        this.isLogin = false;
        // this.loginSubscription.unsubscribe()
    }

}
