import { Component, OnInit } from '@angular/core';
import { routerTransition } from '../../router.animations';
import { CoordinatorService } from 'src/app/providers/coordinator/coordinator.service';

@Component({
    selector: 'app-bs-element',
    templateUrl: './bs-element.component.html',
    styleUrls: ['./bs-element.component.scss'],
    animations: [routerTransition()]
})
export class BsElementComponent implements OnInit {
    coordinatorData = {
        person: {
            name: '',
            last_name: '',
            cellphone : '',
            email : '',
            password: ''
        },
        coordinator: {

        }
    };

    constructor(
        public restCoordinator: CoordinatorService
    ) {

    }

    ngOnInit() { }

    addCoordinator() {
        this.restCoordinator.addCoordinador(this.coordinatorData).subscribe((result) => {
            console.log(result);
          }, (err) => {
            console.log(err);
          });
    }

    public inputValidator(event: any) {
        const pattern = /^[a-zA-Z]*$/;
        if (!pattern.test(event.target.value)) {
        event.target.value = event.target.value.replace(/[^a-zA-Z]/g, '');

        }
      }
}
