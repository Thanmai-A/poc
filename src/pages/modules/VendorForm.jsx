import React from 'react';
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
import * as Yup from 'yup';
import api from '../../api';

const schema = Yup.object().shape({
  name: Yup.string().required(),
  email: Yup.string().email().required(),
  password: Yup.string().min(6).required(),
});

export default function VendorForm({onSuccess}){
  const { register, handleSubmit, reset } = useForm({ resolver: yupResolver(schema) });
  const onSubmit = async data=>{ await api.post('/vendors', data); reset(); onSuccess(); };
  return (
    <form onSubmit={handleSubmit(onSubmit)} className="row g-2">
      <div className="col-md-3"><input className="form-control" placeholder="Name" {...register('name')} /></div>
      <div className="col-md-3"><input className="form-control" placeholder="Email" {...register('email')} /></div>
      <div className="col-md-3"><input className="form-control" type="password" placeholder="Password" {...register('password')} /></div>
      <div className="col-md-3"><button className="btn btn-success">Add Vendor</button></div>
    </form>
  );
}
