import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import LoginPage from './pages/LoginPage';
import AdminDashboard from './pages/admin/AdminDashboard';
import ProcurementDashboard from './pages/procurement/ProcurementDashboard';
import FinanceDashboard from './pages/finance/FinanceDashboard';
import VendorDashboard from './pages/vendor/VendorDashboard';
import VendorsList from './pages/vendors/VendorsList';
import PendingVendors from './pages/vendors/PendingVendors';
import ContractsPage from './pages/contracts/ContractsPage';
import MessagesPage from './pages/messages/MessagesPage';
import CertificationsPage from './pages/certifications/CertificationsPage';
import RatingsPage from './pages/ratings/RatingsPage';
export default function App(){
  return (
    <AuthProvider>
      <Routes>
        <Route path="/" element={<Navigate to="/login" replace />} />
        <Route path="/login" element={<LoginPage/>} />
        <Route path="/admin" element={<AdminDashboard/>} />
        <Route path="/admin/vendors" element={<VendorsList/>} />
        <Route path="/procurement" element={<ProcurementDashboard/>} />
        <Route path="/procurement/pending" element={<PendingVendors/>} />
        <Route path="/finance" element={<FinanceDashboard/>} />
        <Route path="/vendor" element={<VendorDashboard/>} />
        <Route path="/contracts" element={<ContractsPage/>} />
        <Route path="/messages" element={<MessagesPage/>} />
        <Route path="/certifications" element={<CertificationsPage/>} />
        <Route path="/ratings" element={<RatingsPage/>} />
      </Routes>
    </AuthProvider>
  );
}
