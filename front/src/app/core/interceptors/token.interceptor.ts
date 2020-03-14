import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { tap, catchError } from 'rxjs/operators';
import { UsersService } from 'src/app/services/users.service';
import { StorageService } from 'src/app/services/storage.service';
@Injectable({
  providedIn: 'root'
})
export class TokenInterceptor implements HttpInterceptor {

  constructor(
    private usersService: UsersService,
    private storageService: StorageService
  ) { }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    request = request.clone({
      setHeaders: {
        Authorization: `Bearer ` + this.storageService.getToken()?.token
      }
    });

    return next.handle(request).pipe(
      tap((response: any) => {
        return response;
      }),
      catchError((error: any) => {
        if (error.status === 401) {
          this.usersService.doLogout();
        }
        return throwError(error);
      })
    );
  }

}
