import { Injectable, NotFoundException } from '@nestjs/common';
import { PrismaService } from '../prisma/prisma.service';
import { User } from '@prisma/client';
import * as bcrypt from 'bcryptjs';

@Injectable()
export class UsersService {
  constructor(private prisma: PrismaService) {}

  async getAllUsers(): Promise<User[]> {
    return this.prisma.user.findMany();
  }

  async getUserById(id: number): Promise<User> {
    const user = await this.prisma.user.findUnique({
      where: { id }
    });
    
    if (!user) {
      throw new NotFoundException(`L'utilisateur avec l'ID ${id} n'existe pas`);
    }
    return user;
  }

  async createUser(userData: { name: string; email: string; password: string }): Promise<User> {
    const hashedPassword = await bcrypt.hash(userData.password, 10);
    return this.prisma.user.create({
      data: {
        name: userData.name,
        email: userData.email,
        password: hashedPassword
      }
    });
  }

  async updateUser(id: number, userData: { name?: string; email?: string; password?: string }): Promise<User> {
    const existingUser = await this.getUserById(id);
    
    if (userData.password) {
      userData.password = await bcrypt.hash(userData.password, 10);
    }
    return this.prisma.user.update({
      where: { id },
      data: userData
    });
  }

  async deleteUser(id: number): Promise<User> {
    await this.getUserById(id);
    return this.prisma.user.delete({
      where: { id }
    });
  }
}