import React from 'react';
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
import * as Yup from 'yup';
import api from '../../api';

const schema = Yup.object().shape({
  sender_id: Yup.number().required(),
  receiver_id: Yup.number().required(),
  content: Yup.string().required(),
});

export default function MessageForm({onSuccess}){
  const { register, handleSubmit, reset } = useForm({ resolver: yupResolver(schema) });
  const onSubmit = async data=>{ await api.post('/messages', data); reset(); onSuccess(); };
  return (
    <form onSubmit={handleSubmit(onSubmit)} className="row g-2">
      <div className="col-md-3"><input className="form-control" placeholder="Sender ID" {...register('sender_id')} /></div>
      <div className="col-md-3"><input className="form-control" placeholder="Receiver ID" {...register('receiver_id')} /></div>
      <div className="col-md-4"><input className="form-control" placeholder="Message" {...register('content')} /></div>
      <div className="col-md-2"><button className="btn btn-success">Send</button></div>
    </form>
  );
}
