import React, { createContext, useContext, useState } from 'react';
import api from '../api';
import { useNavigate } from 'react-router-dom';
const AuthContext = createContext(null);
export const useAuth = () => useContext(AuthContext);
export const AuthProvider = ({ children }) => {
  const [auth, setAuth] = useState({ token: localStorage.getItem('token') || null, user: JSON.parse(localStorage.getItem('user') || 'null') });
  const navigate = useNavigate();
  const login = async (email, password) => {
    const { data } = await api.post('/auth/login', { email, password });
    localStorage.setItem('token', data.access_token);
    localStorage.setItem('user', JSON.stringify(data.user));
    setAuth({ token: data.access_token, user: data.user });
    const role = data.user.role;
    if(role === 'admin') navigate('/admin');
    else if(role === 'procurement') navigate('/procurement');
    else if(role === 'finance') navigate('/finance');
    else navigate('/vendor');
  };
  const logout = async () => { try { await api.post('/auth/logout'); } catch {} localStorage.removeItem('token'); localStorage.removeItem('user'); setAuth({ token:null,user:null }); navigate('/login'); };
  return (<AuthContext.Provider value={{ ...auth, login, logout }}>{children}</AuthContext.Provider>);
};
