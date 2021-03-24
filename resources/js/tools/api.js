import axios from 'axios';
import defined from './defined.js';

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

  userInfo() {
    return this.sendRequest("/api/user/info", "GET", true);
  }

  checkIn(data) {
    return this.sendRequest("/api/check/in", "POST", true, data);
  }

  checkOut(data) {
    return this.sendRequest("/api/check/out", "POST", true, data);
  }

  leave(data) {
    return this.sendRequest("/api/leave/apply", "POST", true, data);
  }

  getCheckRecords() {
    return this.sendRequest("/api/user/checks", "GET", true);
  }

  getLeaveRecords() {
    return this.sendRequest("/api/user/leaves", "GET", true);
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

    if (this.unauthorized.indexOf(promise.data.status) !== -1) {
      window.location.href = '/login';
    } else {
      return promise;
    }
  }
}

export default new Api();