import React, { useEffect, useState } from 'react';
import TopNav from '../../components/TopNav';
import PrivateRoute from '../../components/PrivateRoute';
import api from '../api';
import { Container, Row, Col, Card, Table, Badge } from 'react-bootstrap';
export default function AdminDashboard(){ const [metrics,setMetrics]=useState(null); const [vendors,setVendors]=useState([]);
  useEffect(()=>{ (async ()=>{ try{ const m=await api.get('/admin/metrics'); setMetrics(m.data); }catch{} try{ const v=await api.get('/admin/vendors'); setVendors(v.data);}catch{} })(); },[]);
  return (<PrivateRoute allow={['admin']}><TopNav/><Container><h2 className="mb-3">Admin Dashboard</h2>
    <Row className="mb-3"><Col md={3}><Card className="p-3">Total Vendors <h4>{metrics?.totalVendors ?? '-'}</h4></Card></Col>
    <Col md={3}><Card className="p-3">Pending <h4>{metrics?.pendingVendors ?? '-'}</h4></Card></Col>
    <Col md={3}><Card className="p-3">Contracts <h4>{metrics?.activeContracts ?? '-'}</h4></Card></Col>
    <Col md={3}><Card className="p-3">Expiring Certs <h4>{metrics?.expiringCerts ?? '-'}</h4></Card></Col></Row>
    <Card className="p-3"><h5>Vendors</h5><Table striped bordered hover><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Status</th></tr></thead><tbody>{vendors.map(v=>(<tr key={v.id}><td>{v.id}</td><td>{v.name||v.company_name}</td><td>{v.email}</td><td><Badge bg={v.status==='approved'?'success':'warning'}>{v.status}</Badge></td></tr>))}</tbody></Table></Card></Container></PrivateRoute>);
}
