import axios from "axios";

const BASE_URL = 'http://localhost:8000/api/local';

const token = localStorage.getItem('access-token');

const axiosInstance = axios.create({
  baseURL: BASE_URL,
  withCredentials: true,
  headers: {
    "Content-Type": "application/json",
    Authorization: `Bearer ${token}`,
  },
});

export default axiosInstance;
