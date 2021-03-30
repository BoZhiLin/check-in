import Base from "./base.js";

class Admin extends Base {
  constructor() {
    super();
    this.redirect = "/admin/login";
  }

  login(data) {
    return this.sendRequest("/admin/api/auth/login", "POST", false, data, null, true);
  }

  logout() {
    return this.sendRequest("/admin/api/auth/logout", "POST", true);
  }
}

export default new Admin();