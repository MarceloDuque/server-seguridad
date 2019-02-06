import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { TranslateService } from '@ngx-translate/core';
import { routerTransition } from '../router.animations';
import { AgreementService } from '../providers/agreement/agreement.service';


@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss'],
    animations: [routerTransition()]
})
export class LoginComponent implements OnInit {
    constructor(
        private translate: TranslateService,
        public router: Router,
        public rest: AgreementService
    ) {
        this.translate.addLangs(['en', 'fr', 'ur', 'es', 'it', 'fa', 'de', 'zh-CHS']);
        this.translate.setDefaultLang('en');
        const browserLang = this.translate.getBrowserLang();
        this.translate.use(browserLang.match(/en|fr|ur|es|it|fa|de|zh-CHS/) ? browserLang : 'en');
    }

    ngOnInit() { 
        this.test();
    }

    onLoggedin() {
        localStorage.setItem('isLoggedin', 'true');
    }

    test() {

        this.rest.test().subscribe((data: {}) => {
            console.log(data);

        });
    }
}
