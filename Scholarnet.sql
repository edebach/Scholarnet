PGDMP     $    %                {        
   Scholarnet    15.2    15.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16398 
   Scholarnet    DATABASE        CREATE DATABASE "Scholarnet" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Italian_Italy.1252';
    DROP DATABASE "Scholarnet";
                postgres    false            �            1259    16399    utente    TABLE     �   CREATE TABLE public.utente (
    nome character varying(25),
    cognome character varying(25),
    email character varying(50),
    pass character varying(25),
    istituto character varying(50)
);
    DROP TABLE public.utente;
       public         heap    postgres    false            �          0    16399    utente 
   TABLE DATA           F   COPY public.utente (nome, cognome, email, pass, istituto) FROM stdin;
    public          postgres    false    214   �       �   �   x�=N��0�v�`���	
_ 菛8������'����|�	��!�L�[g��/��� �M]�q����cN�G�y��#.82%�W����΃������Rt�y�*uƞ#����3��j&�Q�8��GV�|VY��_�� �٭�k�
�M#�Z1'��@�t��!˖1��N+�~�U\|     