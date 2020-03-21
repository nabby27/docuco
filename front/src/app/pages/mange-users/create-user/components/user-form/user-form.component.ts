import { Component, Input, Output, EventEmitter } from '@angular/core';
import { User } from 'src/app/entities/user';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { UsersService } from 'src/app/services/users.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-form',
  templateUrl: './user-form.component.html',
  styleUrls: ['./user-form.component.scss']
})
export class UserFormComponent {

  @Output() userCreated = new EventEmitter();

  userForm: FormGroup;
  role: string;
  email: string;
  name: string;

  constructor(
    private fb: FormBuilder,
    private userService: UsersService,
    private snackBar: MatSnackBar,
    private router: Router
  ) { }

  ngOnInit() {
    this.setFormData();
  }

  private setFormData() {
    this.userForm = this.fb.group({
      role: [{ value: '', disabled: false }, [Validators.required]],
      email: [{ value: '', disabled: false }, [Validators.required, Validators.email]],
      name: [{ value: '', disabled: false }, [Validators.required]]
    });
  }

  async save() {
    await this.userService.saveUser(this.userForm.value);
    this.router.navigate(['/list-users']);
    this.userCreated.emit();
    this.showMessage('Usuario guardado');
  }

  private showMessage(message: string) {
    this.snackBar.open(message, null, {
      duration: 5000,
      verticalPosition: 'top'
    });
  }

}
