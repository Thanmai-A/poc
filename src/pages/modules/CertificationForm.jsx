import React from 'react';
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
import * as Yup from 'yup';
import api from '../../api';

const schema = Yup.object().shape({
  vendor_id: Yup.number().required(),
  type: Yup.string().required(),
  expiry_date: Yup.date().required(),
});

export default function CertificationForm({onSuccess}){
  const { register, handleSubmit, reset } = useForm({ resolver: yupResolver(schema) });
  const onSubmit = async data=>{ await api.post('/certifications', data); reset(); onSuccess(); };
  return (
    <form onSubmit={handleSubmit(onSubmit)} className="row g-2">
      <div className="col-md-3"><input className="form-control" placeholder="Vendor ID" {...register('vendor_id')} /></div>
      <div className="col-md-3"><input className="form-control" placeholder="Type" {...register('type')} /></div>
      <div className="col-md-3"><input className="form-control" type="date" {...register('expiry_date')} /></div>
      <div className="col-md-3"><button className="btn btn-success">Add Cert</button></div>
    </form>
  );
}
