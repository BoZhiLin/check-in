import axios from 'axios';
import defined from './defined.js';
import router from '../router/index.js';

class Api {
  constructor() {
    this.unauthorized = [
      defined.response.UNAUTHORIZED,
      defined.response.TOKEN_INVALID,
      defined.response.TOKEN_EXPIRED
    ];
  }

  userLogin(data) {
    return this.sendRequest("/api/auth/login", "POST", false, data);
  }

  checkIn(data) {
    return this.sendRequest("/api/check/in", "POST", true, data);
  }

  getUserRecord() {
    return this.sendRequest("/api/check/search", "GET", true);
  }

  async sendRequest(url, method, withToken, body, queryString) {
    let headers = {
      Accept: "application/json"
    };

    if (withToken === true) {
      let token = localStorage["access_token"] || '';
      headers["Authorization"] = `bearer ${token}`;
    }

    const promise = await axios({
      url: url,
      method: method,
      data: body,
      headers: headers,
      params: queryString
    });

    return promise;
  }
}

export default new Api();