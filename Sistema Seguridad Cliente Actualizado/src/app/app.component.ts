import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {

    formulario:FormGroup

    constructor(private fb:FormBuilder) {
        this.formulario = fb.group({
            name:[null, Validators.required],
            email:[null, Validators.email],
            phone:[null, Validators.compose([Validators.required, Validators.maxLength(10)])]
        })
    }



    
    ngOnInit() {
    }
}
