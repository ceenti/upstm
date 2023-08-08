import React from 'react'
import { Header } from '../Shared/'

export const MainLayout = ({children}) => {
  return (
    <>
    <Header />
    {children}</>
  )
}
