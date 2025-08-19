import React, { useEffect, useState } from 'react';
import api from '../../api';
import VendorForm from './VendorForm';
export default function VendorManagement(){
  const [vendors,setVendors] = useState([]);
  const fetch = ()=>api.get('/vendors').then(r=>setVendors(r.data)).catch(()=>{});
  useEffect(fetch,[]);
  const del = id=>api.delete(`/vendors/${id}`).then(fetch);
  return (
    <div>
      <h4>Vendors</h4>
      <VendorForm onSuccess={fetch}/>
      <table className="table mt-3">
        <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Company</th><th>Status</th><th></th></tr></thead>
        <tbody>
          {vendors.map((v,i)=>(
            <tr key={v.id}><td>{i+1}</td><td>{v.name}</td><td>{v.email}</td><td>{v.company_name}</td><td>{v.status}</td><td><button className="btn btn-sm btn-danger" onClick={()=>del(v.id)}>Delete</button></td></tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
