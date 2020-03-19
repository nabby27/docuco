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
  name: string;
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
      name: [{ value: this.name, disabled: false }, [Validators.required]],
      email: [{ value: this.description, disabled: false }],
      type: [{ value: '', disabled: false }, [Validators.required]],
      date_of_issue: [{ value: this.date_of_issue, disabled: false }, [Validators.required]],
      price: [{ value: this.price, disabled: false }, [Validators.required]],
    });
  }

}
