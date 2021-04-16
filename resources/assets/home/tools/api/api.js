import Base from "./base.js";
``
class Api extends Base {
  constructor() {
    super();
    this.redirect = "/login";
  }

  userLogin(data) {
    return this.sendRequest("/api/auth/login", "POST", false, data, null, true);
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
}

export default new Api();