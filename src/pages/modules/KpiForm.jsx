import React from 'react';
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
import * as Yup from 'yup';
import api from '../../api';

const schema = Yup.object().shape({
  vendor_id: Yup.number().required(),
  metric: Yup.string().required(),
  score: Yup.number().min(0).max(100).required(),
});

export default function KpiForm({onSuccess}){
  const { register, handleSubmit, reset } = useForm({ resolver: yupResolver(schema) });
  const onSubmit = async data=>{ await api.post('/kpis', data); reset(); onSuccess(); };
  return (
    <form onSubmit={handleSubmit(onSubmit)} className="row g-2">
      <div className="col-md-3"><input className="form-control" placeholder="Vendor ID" {...register('vendor_id')} /></div>
      <div className="col-md-3"><input className="form-control" placeholder="Metric" {...register('metric')} /></div>
      <div className="col-md-3"><input className="form-control" type="number" placeholder="Score" {...register('score')} /></div>
      <div className="col-md-3"><button className="btn btn-success">Add KPI</button></div>
    </form>
  );
}
