import { Component, Input } from '@angular/core';
import { User } from 'src/app/entities/user';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-user-form',
  templateUrl: './user-form.component.html',
  styleUrls: ['./user-form.component.scss']
})
export class UserFormComponent {

  @Input() user: User;

  userForm: FormGroup;
  role: string;

  description: string;
  date_of_issue: Date = new Date();
  price: number;
  type: string;

  constructor(
    private fb: FormBuilder
  ) { }

  ngOnInit() {
    this.setFormData();
  }

  private setFormData() {
    this.userForm = this.fb.group({
      role: [{ value: this.user.role, disabled: false }, [Validators.required]],
      email: [{ value: this.user.email, disabled: false }, [Validators.required, Validators.email]],
      name: [{ value: this.user.name, disabled: false }, [Validators.required]]
    });
  }

}
