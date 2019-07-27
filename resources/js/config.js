import axios from 'axios';

export const ssoApi = 'http://127.0.0.1:8000';

export const ssoHttp = axios.create({
  baseURL: ssoApi,
});
