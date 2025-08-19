import React, { useEffect, useState } from "react";
import api from "../api";
import VendorManagement from "./modules/VendorManagement";
import ContractManagement from "./modules/ContractManagement";
import CertificationManagement from "./modules/CertificationManagement";
import KpiManagement from "./modules/KpiManagement";
import MessageManagement from "./modules/MessageManagement";

export default function AdminDashboard(){
  const [tab,setTab] = useState('vendors');
  const [stats,setStats] = useState({});

  useEffect(()=>{ api.get('/admin/dashboard').then(r=>setStats(r.data)).catch(()=>{}); },[]);

  return (
    <div className="container mt-4">
      <h2>Admin Dashboard</h2>
      <div className="mb-3">
        <button className={`btn me-2 ${tab==='vendors'?'btn-primary':'btn-outline-primary'}`} onClick={()=>setTab('vendors')}>Vendors</button>
        <button className={`btn me-2 ${tab==='contracts'?'btn-primary':'btn-outline-primary'}`} onClick={()=>setTab('contracts')}>Contracts</button>
        <button className={`btn me-2 ${tab==='certifications'?'btn-primary':'btn-outline-primary'}`} onClick={()=>setTab('certifications')}>Certifications</button>
        <button className={`btn me-2 ${tab==='kpis'?'btn-primary':'btn-outline-primary'}`} onClick={()=>setTab('kpis')}>KPIs</button>
        <button className={`btn me-2 ${tab==='messages'?'btn-primary':'btn-outline-primary'}`} onClick={()=>setTab('messages')}>Messages</button>
      </div>

      {tab==='vendors' && <VendorManagement />}
      {tab==='contracts' && <ContractManagement />}
      {tab==='certifications' && <CertificationManagement />}
      {tab==='kpis' && <KpiManagement />}
      {tab==='messages' && <MessageManagement />}
    </div>
  );
}
