import {CONFIG as config} from './config';

let pathname = location.pathname.replace(`${parseInt(location.pathname.match(/\d+/))}/`, '');

for (let url in config) {
    if (pathname.includes(url)) {
        for (let func of config[url]) {
            func()
        }
    }
}
