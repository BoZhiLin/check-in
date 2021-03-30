import axios from "axios";
import defined from "../defined.js";

class Base {
  constructor() {
    this.unauthorized = [
      defined.response.UNAUTHORIZED,
      defined.response.TOKEN_INVALID,
      defined.response.TOKEN_EXPIRED
    ];
  }

  async sendRequest(url, method, withToken, body, queryString, directPromise = false) {
    let headers = {
      Accept: "application/json"
    };

    if (withToken === true) {
      let token = localStorage["access_token"] || "";
      headers["Authorization"] = `bearer ${token}`;
    }

    const promise = await axios({
      url: url,
      method: method,
      data: body,
      headers: headers,
      params: queryString
    });

    if (directPromise) {
      return promise;
    } else {
      if (this.unauthorized.indexOf(promise.data.status) !== -1) {
        window.location.href = this.redirect;
      } else {
        return promise;
      }
    }
  }
}

export default Base;