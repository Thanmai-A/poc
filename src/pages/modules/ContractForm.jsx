import React from 'react';
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
import * as Yup from 'yup';
import api from '../../api';

const schema = Yup.object().shape({
  vendor_id: Yup.number().required(),
  title: Yup.string().required(),
  start_date: Yup.date().required(),
  end_date: Yup.date().required(),
});

export default function ContractForm({onSuccess}){
  const { register, handleSubmit, reset } = useForm({ resolver: yupResolver(schema) });
  const onSubmit = async data=>{ await api.post('/contracts', data); reset(); onSuccess(); };
  return (
    <form onSubmit={handleSubmit(onSubmit)} className="row g-2">
      <div className="col-md-3"><input className="form-control" placeholder="Vendor ID" {...register('vendor_id')} /></div>
      <div className="col-md-3"><input className="form-control" placeholder="Title" {...register('title')} /></div>
      <div className="col-md-2"><input className="form-control" type="date" {...register('start_date')} /></div>
      <div className="col-md-2"><input className="form-control" type="date" {...register('end_date')} /></div>
      <div className="col-md-2"><button className="btn btn-success">Add Contract</button></div>
    </form>
  );
}
