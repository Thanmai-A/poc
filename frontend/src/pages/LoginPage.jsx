import React from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import { Container, Card, Button } from 'react-bootstrap';
import { useAuth } from '../context/AuthContext';
const schema = Yup.object({ email: Yup.string().email().required(), password: Yup.string().min(6).required() });
export default function LoginPage(){ const { login } = useAuth();
  return (<Container style={{maxWidth:420}}><Card className="p-4 mt-5"><h3 className="mb-3">Login</h3>
    <Formik initialValues={{email:'',password:''}} validationSchema={schema} onSubmit={async (vals,{setSubmitting,setStatus})=>{ setStatus(null); try{ await login(vals.email,vals.password);}catch(e){ setStatus('Invalid credentials'); } finally{ setSubmitting(false); } }}>
    {({isSubmitting,status})=>(<Form><div className="mb-3"><label>Email</label><Field name="email" className="form-control"/><div className="text-danger"><ErrorMessage name="email"/></div></div>
    <div className="mb-3"><label>Password</label><Field name="password" type="password" className="form-control"/><div className="text-danger"><ErrorMessage name="password"/></div></div>
    {status && <div className="text-danger mb-2">{status}</div>}<Button type="submit" disabled={isSubmitting}>Login</Button></Form>)}</Formik></Card></Container>);
}
