import React, { useState } from 'react';
import api from '../api';
import { useNavigate } from 'react-router-dom';

export default function LoginPage() {
  const [email,setEmail] = useState('admin@example.com');
  const [password,setPassword] = useState('password');
  const navigate = useNavigate();

  const handle = async (e) => {
    e.preventDefault();
    try {
      const { data } = await api.post('/auth/login',{ email, password });
      localStorage.setItem('token', data.access_token);
      localStorage.setItem('user', JSON.stringify(data.user));
      navigate('/admin');
    } catch (err) { alert('Login failed'); console.error(err); }
  };

  return (
    <div className="container mt-5" style={{maxWidth:480}}>
      <h3>Vendor Portal Login</h3>
      <form onSubmit={handle}>
        <div className="mb-3">
          <label>Email</label>
          <input className="form-control" value={email} onChange={e=>setEmail(e.target.value)} />
        </div>
        <div className="mb-3">
          <label>Password</label>
          <input type="password" className="form-control" value={password} onChange={e=>setPassword(e.target.value)} />
        </div>
        <button className="btn btn-primary">Login</button>
      </form>
    </div>
  );
}
